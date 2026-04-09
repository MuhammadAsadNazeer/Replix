[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![Platform](https://img.shields.io/badge/platform-Windows%20|%20macOS%20|%20Linux-lightgrey)](https://hedows.com/portfolio/replix/)
[![Version](https://img.shields.io/badge/version-1.0-green)](https://hedows.com/portfolio/replix/)

# Replix - Advanced Search and Replace (https://hedows.com/portfolio/replix/)
Replix is a powerful yet easy-to-use tool for finding and replacing text across files, folders, or entire projects. Whether you're a developer, writer, or data wrangler, Replix makes bulk text replacements fast, accurate, and stress-free.</br></br>

![Replix - Search and Replace](https://github.com/user-attachments/assets/aa42b7c9-ffa5-488d-ab45-e78e4e87db86)

## Features at a glance

| Option | What it does |
|--------|----------------|
| **Case Sensitive** | Distinguishes between uppercase and lowercase letters. |
| **Search Content** | Searches inside file contents vs. only file/folder names. |
| **Occurrences** | Shows exactly how many matches were found and replaced. |</br></br>

## Case Sensitive </br>

Controls whether letter casing matters during search.

| Setting | Behavior |
|---------|----------|
|**Checked** | Exact match required. Searching `"Cat"` will **not** find `"cat"` or `"CAT"`. |
|**Unchecked** | Ignores case. `"Cat"`, `"cat"`, `"CAT"` are all treated the same. |

> **When to use:** Programming (variable names like `count` vs `Count`), password‑like searches, or any case‑sensitive data.</br>

## Search Content

Decides if Replix should look inside files or only scan names.

| Setting | Behavior |
|---------|----------|
| **Checked** | Scans and replaces text **inside** files (code, logs, documents). |
| **Unchecked** | Only matches **file names** and **folder names** — useful for batch renaming. |

> **When to use:** Refactoring code across a project (checked) vs renaming 100 photos (unchecked).</br>

## Occurrences

After each operation, Replix displays a clear summary:

> **“12 matches found and replaced”**

This tells you exactly how many times your search term appeared and was changed. Perfect for auditing large updates.</br></br>

## Quick example

**Before:**  
File `notes.txt` contains:  
> *“I love cats. Cats are great.”*

**Search:** `"cats"` → **Replace:** `"dogs"`  
**Case Sensitive:** Unchecked  

**After:**  
> *“I love dogs. Dogs are great.”*

**Occurrences reported:** `2 matches replaced`</br></br>

## Common use cases

- **Developers** – Refactor variable names, update imports, change API endpoints across a whole project.
- **Writers** – Fix recurring typos or rename characters in manuscript files.
- **Data organizers** – Batch rename files (`IMG_001.jpg` → `vacation_001.jpg`).
- **DevOps** – Replace environment tokens in config files.</br></br>

## Getting started

1. **Download** Replix from [hedows.com/portfolio/replix](https://hedows.com/portfolio/replix/)
2. **Launch** the application.
3. **Select** your target directory.
4. **Enter** your search and replace text.
5. **Adjust** options (Case Sensitive, Search Content).
6. **Click** *Replace* – view the occurrence count and changes.</br></br>

## License
MIT © [Hedows](https://hedows.com)
