import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

# Check what user message format looks like
sid = "ses_0901264beffeI51a1CJcONvPqS"
cur.execute("""
    SELECT m.id, json_extract(m.data, '$.role') as role, m.data as raw_data
    FROM message m
    WHERE m.session_id = ?
    ORDER BY m.time_created
    LIMIT 5
""", (sid,))
print("=== MESSAGE DATA SAMPLES ===")
for r in cur.fetchall():
    d = json.loads(r['raw_data'])
    print(f"  Role: {d.get('role')}, Keys: {list(d.keys())}")
    if d.get('role') == 'user':
        # Check if content is a list or string
        c = d.get('content')
        if isinstance(c, list):
            for item in c:
                if isinstance(item, dict) and item.get('type') == 'text':
                    print(f"    Text: {item['text'][:200]}")
        elif isinstance(c, str):
            print(f"    Text: {c[:200]}")
    print()

# Get all user messages across ALL sessions for this project
print("\n=== ALL USER MESSAGES FOR THIS PROJECT (recent sessions) ===")
proj_sessions = [
    "ses_08c01c761ffeBAZN5zTZPsdQWQ",
    "ses_0901264beffeI51a1CJcONvPqS",
    "ses_09020f0efffeP2n7acSxikw1lb",
]
for sid in proj_sessions:
    cur.execute("""
        SELECT m.id, m.data as raw_data, m.time_created
        FROM message m
        WHERE m.session_id = ?
        ORDER BY m.time_created
    """, (sid,))
    ts = cur.fetchone()
    if not ts:
        continue
    ts_time = ts['time_created'] / 1000
    print(f"\n--- {sid} | {time.strftime('%Y-%m-%d %H:%M', time.localtime(ts_time))} ---")
    cur.execute("""
        SELECT m.id, m.data as raw_data
        FROM message m
        WHERE m.session_id = ?
        ORDER BY m.time_created
    """, (sid,))
    for r in cur.fetchall():
        d = json.loads(r['raw_data'])
        if d.get('role') == 'user':
            c = d.get('content')
            text = ''
            if isinstance(c, list):
                for item in c:
                    if isinstance(item, dict) and item.get('type') == 'text':
                        text += item['text']
            elif isinstance(c, str):
                text = c
            if text.strip():
                preview = text.strip()[:300].replace('\n', ' ')
                print(f"  User: {preview}")

conn.close()
