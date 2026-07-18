import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

# Session 1: Changing login and register front-end (ses_0901264beffeI51a1CJcONvPqS)
# 254 messages - let's look at user messages and key assistant actions
sid = "ses_0901264beffeI51a1CJcONvPqS"
print(f"=== SESSION: {sid} ===")
print("Changing login and register front-end")

# Get user messages
cur.execute("""
    SELECT m.id, json_extract(m.data, '$.role') as role, json_extract(m.data, '$.content') as content
    FROM message m
    WHERE m.session_id = ?
    ORDER BY m.time_created
""", (sid,))
print("\n--- USER MESSAGES ---")
for r in cur.fetchall():
    role = r['role']
    content = r['content'] or ''
    if role == 'user' and content.strip():
        preview = content[:300].replace('\n', ' ')
        print(f"  [{role}] {preview}")

# Get key tool calls (writes/edits)
print("\n--- TOOL CALLS (write/edit/bash) ---")
cur.execute("""
    SELECT m.id, json_extract(p.data, '$.type') as part_type,
           json_extract(p.data, '$.tool') as tool,
           substr(p.data, 1, 500) as preview
    FROM message m
    JOIN part p ON p.message_id = m.id
    WHERE m.session_id = ?
      AND json_extract(m.data, '$.role') = 'assistant'
      AND json_extract(p.data, '$.tool') IN ('write', 'edit', 'bash')
    ORDER BY m.time_created, p.time_created
    LIMIT 40
""", (sid,))
for r in cur.fetchall():
    tool = r['tool']
    preview = r['preview'][:250].replace('\n', ' ')
    print(f"  [{tool}] {preview}")

conn.close()
