import requests
from datetime import datetime
from escpos.printer import Usb
from PIL import Image
import textwrap
import html

URL = "https://gb.pnppl.cc/"
PASSWD = "hackme"
with open(".passwd", "r") as passwd:
	PASSWD = passwd.read().strip()
LOG = "print.log"
PRINTER = Usb(0x6868, 0x0200, 0, profile="POS-5890")
FULL_SIZE_TXT = 256
FULL_SIZE_IMG = 384

FIELD_COUNT = 6
UTIME = 0
NAME = 1
HOMEPAGE = 2
EMAIL = 3
COMMENT = 4
ART = 5

TIME_FMT_PRINT = "%Y-%m-%d (%a.) @ %H:%M:%S"
TIME_FMT_LOG = "%Y-%m-%d @ %H:%M:%S"

IMG_PREFIX = "./pbm/"
LAST_TIME_TXT = "last.time"

def flip_print(text: str):
	lines = textwrap.wrap(text, width=32, break_long_words=True)
	lines.reverse()
	for line in lines:
		PRINTER.textln(line)

def poll_and_print():
	message: str = ''

	# find out what timestamp to fetch
	with open(LAST_TIME_TXT) as file:
		LAST = file.read().strip()

	# fetch from timestamp
	new = requests.get(f"{URL}new/?utime={LAST}").text
	if len(new) <= FIELD_COUNT:
		return "no new"

	# parse tsv
	entries_raw = new.split("\n")
	entries = []
	for line in range(len(entries_raw)):
		entry = entries_raw[line].split("\t")
		if len(entry) == FIELD_COUNT:
			entries.append(entry)

	# print
	for e in range(len(entries)):
		entry = entries[e]
		message += 'printing ' + entry[UTIME] + "..."

		PRINTER.set(flip=True)

		# print hr and art first due to flip
		PRINTER.textln('')
		PRINTER.textln('')
		PRINTER.textln(' _ * ~ * _ * ~ * _ * ~ * _ * ~')
		PRINTER.textln('')
		PRINTER.textln('')

		if len(entry[ART]) == FULL_SIZE_TXT:
			PRINTER.textln('')
			pbm = 'P1 16 16 ' + entry[ART]
			filename_tmp = IMG_PREFIX + ".art.pbm"
			filename_small = IMG_PREFIX + entry[UTIME] + ".pbm"
			with open(filename_small, "wb") as small_img:
				small_img.write(pbm.encode('ascii'))
			Image.open(filename_small).resize((FULL_SIZE_IMG, FULL_SIZE_IMG), Image.NEAREST).rotate(angle=180).save(filename_tmp)
			PRINTER.image(filename_tmp, fragment_height=FULL_SIZE_IMG, center=True)

		if len(entry[COMMENT]) > 0:
			PRINTER.textln('')
			comment = entry[COMMENT].replace('<br>', '\n')
			flip_print(f"« {html.unescape(comment)} »")

		if len(entry[HOMEPAGE]) > 0:
			PRINTER.textln('')
			flip_print(entry[HOMEPAGE])

		print_contents = entry[NAME]
		if len(entry[EMAIL]) > 0:
			print_contents += f" [{entry[EMAIL]}]"
		print_contents += "\n"
		flip_print(print_contents)

		flip_print(f"{datetime.fromtimestamp(int(entry[UTIME])).strftime(TIME_FMT_PRINT)}")
		PRINTER.textln('')

		LAST = entry[UTIME]
		message += " done.\n"

	# update timestamp
	with open(LAST_TIME_TXT, 'w') as file:
		file.write(LAST)

	return message

def post(status):
	reply = requests.post(URL + 'status/', data={'status': status, 'passwd': PASSWD})
	log(reply)

def log(status):
	with open(LOG, 'a') as file:
		file.write("\n")
		file.write(datetime.now().strftime(TIME_FMT_LOG))
		file.write(': ')
		file.write(str(status))

status = poll_and_print().strip()
log(status)
if status != 'no new' && len(status) > 0:
	post(status)
