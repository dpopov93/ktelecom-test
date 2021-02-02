import sys
import xlrd
import csv

###################################################
#                                                 #
#   This script working only with xlrd lib 1.2.0  #
#   For install this lib use:                     #
#                                                 #
#   > pip3 install xlrd==1.2.0                    #
#                                                 #
#   I hope to get hired :-)                       #
#                                                 #
###################################################

def csv_from_excel(input_file_name, output_file_name):
    wb = xlrd.open_workbook(input_file_name)
    sh = wb.sheet_by_name('Sheet')
    your_csv_file = open(output_file_name, 'w')
    wr = csv.writer(your_csv_file, quoting=csv.QUOTE_ALL)

    for rownum in range(sh.nrows):
        wr.writerow(sh.row_values(rownum))

    your_csv_file.close()

if __name__ == '__main__':
    if len(sys.argv) != 3:
        print('Incorrect arguments')
        sys.exit(1)
    else:
        csv_from_excel(sys.argv[1], sys.argv[2])
