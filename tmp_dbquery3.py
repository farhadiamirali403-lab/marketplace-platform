import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

PROJ_ID = "80ce4116-c95d-47db-a02a-30c1274443e3"
seven_days_ago_ms = int(time.time() * 1000) - (7 * 24 * 60 * 60 * 1000)

# Get all sessions for this project (last 7 days), newest first
cur.execute("""
    SELECT id, title, time_created, directory, summary_files, summary_additions, summary_deletions
    FROM session
    WHERE project_id = ? AND time_created > ?
    ORDER BY time_created DESC
""", (PROJ_ID, seven_days_ago_ms))

sessions = []
for r in cur.fetchall():
    sessions.append(dict(r))
    ts = r['time_created'] / 1000
    print(f"  {r['id']} | {time.strftime('%Y-%m-%d %H:%M', time.localtime(ts))} | +{r['summary_additions'] or 0}/-{r['summary_deletions'] or 0} | {r['title'][:100]}")

print(f"\nTotal: {len(sessions)} sessions")

if len(sessions) == 0:
    # Try all sessions for this project (no time filter)
    print("\n=== ALL SESSIONS FOR THIS PROJECT (no time limit) ===")
    cur.execute("""
        SELECT id, title, time_created, summary_files, summary_additions, summary_deletions
        FROM session
        WHERE project_id = ?
        ORDER BY time_created DESC
        LIMIT 20
    """, (PROJ_ID,))
    for r in cur.fetchall():
        ts = r['time_created'] / 1000
        print(f"  {r['id']} | {time.strftime('%Y-%m-%d %H:%M', time.localtime(ts))} | +{r['summary_additions'] or 0}/-{r['summary_deletions'] or 0} | {r['title'][:100]}")

conn.close()
