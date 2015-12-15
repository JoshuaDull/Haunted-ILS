import json


with open("ypk.json") as the_file:

	for a_line in the_file:

		record = json.loads(a_line)

		title = record['title']
		author = record['author']


		print(title,author)
