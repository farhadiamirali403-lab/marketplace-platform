import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

# Search across ALL sessions in this project for user messages with rule-like content
PROJ_ID = "80ce4116-c95d-47db-a02a-30c1274443e3"
cur.execute("SELECT id FROM session WHERE project_id = ?", (PROJ_ID,))
proj_sessions = [r['id'] for r in cur.fetchall()]

print(f"Total project sessions: {len(proj_sessions)}")

# Get all user text parts from all sessions
for sid in proj_sessions:
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
        if text.strip():
            preview = text.strip()[:500].replace('\n', ' ')
            print(f"\n[{sid}] User: {preview}")

conn.close()
