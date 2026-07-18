import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

PROJ_SESSIONS = [
    "ses_08c01c761ffeBAZN5zTZPsdQWQ",
    "ses_0901264beffeI51a1CJcONvPqS",
    "ses_09020f0efffeP2n7acSxikw1lb",
]

# Get all user text parts for each session
for sid in PROJ_SESSIONS:
    cur.execute("SELECT title FROM session WHERE id = ?", (sid,))
    title_row = cur.fetchone()
    title = title_row['title'] if title_row else 'Unknown'
    print(f"\n=== {sid} | {title} ===")
    
    # Get user message texts via part table
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
        preview = text.strip()[:500].replace('\n', ' ')
        if preview:
            print(f"  User: {preview}")

    # Get tool calls that wrote files
    print(f"\n  --- Files written/edited ---")
    cur.execute("""
        SELECT json_extract(p.data, '$.tool') as tool,
               json_extract(json_extract(p.data, '$.state'), '$.input') as inp
        FROM message m
        JOIN part p ON p.message_id = m.id
        WHERE m.session_id = ?
          AND json_extract(m.data, '$.role') = 'assistant'
          AND json_extract(p.data, '$.tool') IN ('write', 'edit')
        ORDER BY m.time_created, p.time_created
    """, (sid,))
    for r in cur.fetchall():
        tool = r['tool']
        inp = r['inp']
        if inp:
            try:
                inp_obj = json.loads(inp) if isinstance(inp, str) else inp
                fp = inp_obj.get('file_path', 'unknown')
                print(f"  [{tool}] {fp}")
            except:
                print(f"  [{tool}] (parse error)")
    
    # Get bash commands
    print(f"\n  --- Bash commands ---")
    cur.execute("""
        SELECT json_extract(json_extract(p.data, '$.state'), '$.input') as inp
        FROM message m
        JOIN part p ON p.message_id = m.id
        WHERE m.session_id = ?
          AND json_extract(m.data, '$.role') = 'assistant'
          AND json_extract(p.data, '$.tool') = 'bash'
        ORDER BY m.time_created
    """, (sid,))
    for r in cur.fetchall():
        inp = r['inp']
        if inp:
            try:
                inp_obj = json.loads(inp) if isinstance(inp, str) else inp
                cmd = inp_obj.get('command', 'unknown')
                print(f"  $ {cmd[:150]}")
            except:
                print(f"  (parse error)")

conn.close()
