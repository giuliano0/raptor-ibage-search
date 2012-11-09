#!/usr/local/bin/python
# coding: utf-8

import sys
import os
import string
	

def projeta(vetorIN,dicio,vetorOUT):
	comando = "QUANTIZA_HISTOGRAMAS.exe " + vetorIN + " " + dicio + " " + vetorOUT + ".hist " + str(+1)
	os.system(comando)
		

#################################################################

vetorIN=sys.argv[1]
dicioIN=sys.argv[2]
vetorOUT = sys.argv[3]
try:
	projeta(vetorIN,dicioIN,vetorOUT)
except Exception as inst:
	print inst
