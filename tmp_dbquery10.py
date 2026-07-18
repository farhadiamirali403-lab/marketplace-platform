import sqlite3, json, time, os

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

# Get the edit details for ses_08c01c761ffeBAZN5zTZPsdQWQ (Removing education section)
sid = "ses_08c01c761ffeBAZN5zTZPsdQWQ"
print(f"=== EDIT DETAILS: {sid} ===")
cur.execute("""
    SELECT json_extract(p.data, '$.tool') as tool,
           json_extract(json_extract(p.data, '$.state'), '$.input') as inp
    FROM message m
    JOIN part p ON p.message_id = m.id
    WHERE m.session_id = ?
      AND json_extract(m.data, '$.role') = 'assistant'
      AND json_extract(p.data, '$.tool') = 'edit'
    ORDER BY m.time_created
""", (sid,))
for r in cur.fetchall():
    inp = r['inp']
    if inp:
        try:
            inp_obj = json.loads(inp) if isinstance(inp, str) else inp
            fp = inp_obj.get('file_path', 'unknown')
            old = inp_obj.get('old_string', '')[:200]
            new = inp_obj.get('new_string', '')[:200]
            print(f"  File: {fp}")
            print(f"  Old: {old}")
            print(f"  New: {new}")
            print()
        except:
            pass

# Get assistant text parts for the "removing education" session
print(f"\n=== ASSISTANT TEXT: {sid} ===")
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
    if text.strip():
        print(f"  {text.strip()[:500]}")
        print()

conn.close()

# Also check for existing checkpoint files across ALL session dirs
print("\n=== EXISTING CHECKPOINT FILES ===")
sessions_dir = r"C:\Users\ROG\.local\share\mimocode\memory\sessions"
for entry in os.listdir(sessions_dir):
    cp_path = os.path.join(sessions_dir, entry, 'checkpoint.md')
    if os.path.isfile(cp_path):
        size = os.path.getsize(cp_path)
        print(f"  {entry}/checkpoint.md ({size} bytes)")
