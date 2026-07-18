import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

# Get current project ID
cur.execute("SELECT id, worktree, name FROM project")
for r in cur.fetchall():
    print(f"Project: {r['id']} | {r['worktree']} | {r['name']}")

print()

# Get project_id for sessions
cur.execute("SELECT id FROM project LIMIT 1")
proj_row = cur.fetchone()
proj_id = proj_row['id'] if proj_row else None
print(f"Using project_id: {proj_id}")

# Get recent sessions for this project (last 7 days in epoch millis)
seven_days_ago_ms = int(time.time() * 1000) - (7 * 24 * 60 * 60 * 1000)
print(f"Seven days ago (ms): {seven_days_ago_ms}")

cur.execute("""
    SELECT id, title, time_created, directory, summary_files, summary_additions, summary_deletions
    FROM session
    WHERE project_id = ? AND time_created > ?
    ORDER BY time_created DESC
""", (proj_id, seven_days_ago_ms))

sessions = []
for r in cur.fetchall():
    sessions.append(dict(r))
    ts = r['time_created'] / 1000
    print(f"  {r['id']} | {time.strftime('%Y-%m-%d %H:%M', time.localtime(ts))} | +{r['summary_additions'] or 0}/-{r['summary_deletions'] or 0} files | {r['title'][:80]}")

print(f"\nTotal recent sessions: {len(sessions)}")

# For non-checkpoint-writer sessions, get their message/part count
print("\n=== SESSION DETAIL ===")
for s in sessions:
    if 'checkpoint-writer' in s['title'] or 'Auto Dream' in s['title'] or 'Auto Distill' in s['title']:
        continue
    sid = s['id']
    ts = s['time_created'] / 1000
    print(f"\n--- {sid} | {time.strftime('%Y-%m-%d %H:%M', time.localtime(ts))} | {s['title']} ---")
    
    # Count messages
    cur.execute("SELECT COUNT(*) FROM message WHERE session_id = ?", (sid,))
    msg_count = cur.fetchone()[0]
    
    # Count parts
    cur.execute("SELECT COUNT(*) FROM part WHERE session_id = ?", (sid,))
    part_count = cur.fetchone()[0]
    
    # Count tasks
    cur.execute("SELECT COUNT(*) FROM task WHERE session_id = ?", (sid,))
    task_count = cur.fetchone()[0]
    
    print(f"  Messages: {msg_count}, Parts: {part_count}, Tasks: {task_count}")
    
    # Get user messages (first few words)
    cur.execute("""
        SELECT substr(json_extract(data, '$.content'), 1, 200) as content_preview
        FROM message
        WHERE session_id = ? AND json_extract(data, '$.role') = 'user'
        ORDER BY time_created
        LIMIT 3
    """, (sid,))
    for r in cur.fetchall():
        preview = r['content_preview'][:150] if r['content_preview'] else 'N/A'
        print(f"  User: {preview}")

conn.close()
