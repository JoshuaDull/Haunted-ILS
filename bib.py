import json
import csv


with open("billi.json") as the_file, open("bib.csv", "w") as out_file:

	w = csv.writer(out_file)
	w.writerow(["Title", "Author", "Language", "Year"])
	for a_line in the_file:

		record = json.loads(a_line)

		try:
			title = record['title']
			author = record['author']
			language = record['lang']
			year = record['publishYear']
			w.writerow([title, author, language, year])
		except:
			continue

