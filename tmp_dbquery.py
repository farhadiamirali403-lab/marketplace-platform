import sqlite3, json, sys

DB = r"C:\Users\ROG\.local\share\mimocode\mimocode.db"
conn = sqlite3.connect(DB)
conn.row_factory = sqlite3.Row
cur = conn.cursor()

# Schema
print("=== SCHEMA ===")
cur.execute("SELECT sql FROM sqlite_master WHERE type='table'")
for r in cur.fetchall():
    print(r[0])
    print()

# List tables
cur.execute("SELECT name FROM sqlite_master WHERE type='table'")
tables = [r[0] for r in cur.fetchall()]
print("Tables:", tables)
print()

# Sessions for this project (last 7 days)
print("=== RECENT SESSIONS (last 7 days) ===")
cur.execute("""
    SELECT id, directory, title, time_created
    FROM session
    WHERE time_created > datetime('now', '-7 days')
    ORDER BY time_created DESC
""")
for r in cur.fetchall():
    print(f"  {r['id']} | {r['time_created']} | {r['title']}")

print()
print("=== ALL SESSIONS (newest first, limit 30) ===")
cur.execute("""
    SELECT id, directory, title, time_created
    FROM session
    ORDER BY time_created DESC
    LIMIT 30
""")
for r in cur.fetchall():
    print(f"  {r['id']} | {r['time_created']} | {r['title']}")

conn.close()
