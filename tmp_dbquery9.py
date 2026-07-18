import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

# Search for key patterns in trajectory text parts
# Look for: "always", "never", "remember", "rule", "decision", "reason", "error", "fix"
patterns = ["error", "fix", "bug", "problem", "issue", "always", "never", "remember", "rule", "decision"]

proj_sessions = [
    "ses_08c01c761ffeBAZN5zTZPsdQWQ",
    "ses_0901264beffeI51a1CJcONvPqS",
    "ses_09020f0efffeP2n7acSxikw1lb",
]

for sid in proj_sessions:
    cur.execute("SELECT title FROM session WHERE id = ?", (sid,))
    title_row = cur.fetchone()
    title = title_row['title'] if title_row else 'Unknown'
    print(f"\n=== {sid} | {title} ===")
    
    # Get assistant text outputs (non-tool parts)
    cur.execute("""
        SELECT json_extract(p.data, '$.text') as text
        FROM message m
        JOIN part p ON p.message_id = m.id
        WHERE m.session_id = ?
          AND json_extract(m.data, '$.role') = 'assistant'
          AND json_extract(p.data, '$.type') = 'text'
        ORDER BY m.time_created
    """, (sid,))
    for r in cur.fetchall():
        text = r['text'] or ''
        if not text.strip():
            continue
        # Check if any pattern matches
        lower_text = text.lower()
        for pat in patterns:
            if pat in lower_text:
                # Find the line containing the pattern
                for line in text.split('\n'):
                    if pat in line.lower():
                        preview = line.strip()[:200]
                        if preview:
                            print(f"  [{pat}] {preview}")
                break  # Only show first matching pattern per part

    # Also look for user messages with these patterns
    cur.execute("""
        SELECT json_extract(p.data, '$.text') as text
        FROM message m
        JOIN part p ON p.message_id = m.id
        WHERE m.session_id = ?
          AND json_extract(m.data, '$.role') = 'user'
          AND json_extract(p.data, '$.type') = 'text'
        ORDER BY m.time_created
    """, (sid,))
    for r in cur.fetchall():
        text = r['text'] or ''
        if not text.strip():
            continue
        lower_text = text.lower()
        for pat in patterns:
            if pat in lower_text:
                preview = text.strip()[:300].replace('\n', ' ')
                print(f"  [user:{pat}] {preview}")
                break

# Also search for errors in bash tool outputs
print("\n=== BASH OUTPUT ERRORS ===")
for sid in proj_sessions:
    cur.execute("""
        SELECT json_extract(json_extract(p.data, '$.state'), '$.output') as output,
               json_extract(json_extract(p.data, '$.state'), '$.input') as inp
        FROM message m
        JOIN part p ON p.message_id = m.id
        WHERE m.session_id = ?
          AND json_extract(m.data, '$.role') = 'assistant'
          AND json_extract(p.data, '$.tool') = 'bash'
        ORDER BY m.time_created
    """, (sid,))
    for r in cur.fetchall():
        output = r['output'] or ''
        inp = r['inp'] or ''
        if 'error' in output.lower() or 'error' in inp.lower() or 'fatal' in output.lower():
            try:
                inp_obj = json.loads(inp) if isinstance(inp, str) else {}
                cmd = inp_obj.get('command', 'unknown')
                print(f"  [{sid}] cmd: {cmd[:100]}")
                print(f"    output: {output[:200]}")
            except:
                pass

conn.close()
