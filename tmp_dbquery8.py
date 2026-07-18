import sqlite3, json, time

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

PROJ_ID = "80ce4116-c95d-47db-a02a-30c1274443e3"

# ALL sessions for this project
cur.execute("""
    SELECT id, title, time_created, summary_files, summary_additions, summary_deletions
    FROM session
    WHERE project_id = ?
    ORDER BY time_created DESC
""", (PROJ_ID,))
print("=== ALL SESSIONS FOR PROJECT ===")
for r in cur.fetchall():
    ts = r['time_created'] / 1000
    print(f"  {r['id']} | {time.strftime('%Y-%m-%d %H:%M', time.localtime(ts))} | +{r['summary_additions'] or 0}/-{r['summary_deletions'] or 0} | {r['title'][:90]}")

conn.close()
