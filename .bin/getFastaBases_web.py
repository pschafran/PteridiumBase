#!/usr/bin/env python
# 2024 Oct 22 (C) Peter W Schafran ps997@cornell.edu
#
# Extracts a range of bases out of a FASTA file. If output sequence name not provided in 4th column of input file, output sequence name is 'contigX_positionX-X'
# Usage: getFastaBases_web.py sequence.fasta contigName startPos endPos

import sys
from Bio import SeqIO

#openSeqFile = open(sys.argv[1], "r")
#openOutFile = open("%s_extractedRegions.fasta" % sys.argv[2], "w")
#openTargetFile = open(sys.argv[2], "r")

seqFile = str(sys.argv[1])
contigName = str(sys.argv[2])
startPos = int(sys.argv[3])
stopPos = int(sys.argv[4])

# check arguments
try:
	records = SeqIO.to_dict(SeqIO.parse(seqFile, "fasta"))
except:
	print("ERROR: Sequence file not found")
	exit(1)
if not contigName in records.keys():
	print("ERROR: Sequence name not in file")
	exit(1)
#if not isinstance(sys.argv[3],int):
#	print("ERROR: Start position must be an integer")
#	exit(1)
if startPos < 1:
	print("ERROR: Start position must be greater than 0")
	exit(1)
if startPos > len(records[contigName].seq):
	print("ERROR: Start position is greater than sequence length")
	exit(1)
#if not isinstance(sys.argv[4],int):
#	print("ERROR: Stop position must be an integer")
#	exit(1)
if stopPos < 1:
	print("ERROR: Stop position must be greater than 0")
	exit(1)
if stopPos > len(records[contigName].seq):
	print("ERROR: Stop position is greater than sequence length")
	exit(1)

# determine sequence direction
if stopPos < startPos:
	reverse = True
	startPos = int(sys.argv[4])
	stopPos = int(sys.argv[3])
else:
	reverse = False

# extract sequence
seqSubset = records[contigName].seq[(startPos-1):stopPos]
if reverse == True:
	seqSubset = str(seqSubset.reverse_complement())
else:
	seqSubset = str(seqSubset)

# output sequence
print(seqSubset)

#openTargetFile.seek(0)
#for targetLine in openTargetFile:
#	reverse = False
#	targetContig = targetLine.strip(">\n").split("\t")[0]
#	startPos = int(targetLine.strip(">\n").split("\t")[1])
#	endPos = int(targetLine.strip(">\n").split("\t")[2])
#	if endPos < startPos:
#		tmpPos = endPos
#		endPos = startPos
#		startPos = tmpPos
#		reverse = True
	# check for bad positions
#	if endPos > len(seqDict[targetContig]):
#		print("ERROR: End position is beyond end of sequence!")
#		print(targetLine)
#		print(len(seqDict[targetContig]))
#		exit(1)
#	if startPos == 1 and endPos == len(seqDict[targetContig]):
#		print("ERROR: Whole sequence selected to be trimmed!")
#		print(targetLine)
#		exit(1)
#	try:
#		openOutFile.write(">%s\n" % targetLine.strip("\n").split("\t")[3])
#	except:
#		openOutFile.write(">%s_pos%s-%s\n" %(targetContig, startPos, endPos))
#	baseCount = 0
#	writeCount = 0
#	seqSubset = seqDict[targetContig][startPos-1:endPos]
#	if reverse == True:
#		dna = Seq("".join(seqSubset))
#		seqSubset = str(dna.reverse_complement())
#	else:
#		seqSubset = "".join(seqSubset)
#	openOutFile.write(seqSubset)
#	#for base in seqDict[targetContig]:
	#	baseCount += 1
	#	if baseCount >= startPos and baseCount <= endPos:
	#		openOutFile.write(base)
	#		writeCount += 1
	#		if writeCount % 80 == 0:
	#			openOutFile.write("\n")
#	openOutFile.write("\n")

#openSeqFile.close()
#openOutFile.close()
#openTargetFile.close()
