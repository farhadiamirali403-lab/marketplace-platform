import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

# Check user message parts
sid = "ses_09020f0efffeP2n7acSxikw1lb"
print(f"=== USER MESSAGE PARTS: {sid} ===")
cur.execute("""
    SELECT m.id as msg_id, json_extract(m.data, '$.role') as role,
           json_extract(m.data, '$.summary') as summary,
           p.id as part_id, json_extract(p.data, '$.type') as part_type,
           substr(p.data, 1, 500) as part_data
    FROM message m
    JOIN part p ON p.message_id = m.id
    WHERE m.session_id = ?
    ORDER BY m.time_created, p.time_created
    LIMIT 20
""", (sid,))
for r in cur.fetchall():
    print(f"  msg={r['msg_id'][:20]} role={r['role']} part_type={r['part_type']} summary={r['summary'][:100] if r['summary'] else 'None'}")
    if r['part_type'] == 'text':
        pd = json.loads(r['part_data'])
        text = pd.get('text', '')[:200]
        print(f"    text: {text}")
    elif r['part_type'] == 'tool':
        pd = json.loads(r['part_data'])
        tool = pd.get('tool', '')
        state = pd.get('state', {})
        inp = state.get('input', {})
        if isinstance(inp, dict):
            # Summarize tool input
            if 'file_path' in inp:
                print(f"    tool={tool} file={inp['file_path']}")
            elif 'command' in inp:
                print(f"    tool={tool} cmd={inp['command'][:100]}")
            elif 'pattern' in inp:
                print(f"    tool={tool} pattern={inp['pattern']}")
            else:
                print(f"    tool={tool} input_keys={list(inp.keys())}")
        else:
            print(f"    tool={tool}")
    print()

conn.close()
