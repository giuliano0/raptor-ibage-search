#!/usr/local/bin/python
# coding: utf-8

import sys
import os
import string
	

def projeta(vetorIN,dicio,vetorOUT):
	dir = os.getcwd()
	dirscripts = dir +"\\assets\\images\\upload\\"
	comando = dirscripts+"QUANTIZA_HISTOGRAMAS.exe " + vetorIN + " " + dicio + " " + vetorOUT + ".hist " + str(+1)
	try:
		os.system(comando)	
	except Exception as e:
		print e
	
		

#################################################################

vetorIN=sys.argv[1]
dicioIN=sys.argv[2]
vetorOUT = sys.argv[3]
try:
	projeta(vetorIN,dicioIN,vetorOUT)
except Exception as inst:
	print inst
