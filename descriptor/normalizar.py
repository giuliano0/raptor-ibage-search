#!/usr/local/bin/python
# coding: utf-8

import sys
import string
import math

def magnitude(v):
   return math.sqrt(sum(float(v[i]) * float(v[i]) for i in range(len(v))))
   
def normalize(v):
   vmag = magnitude(v)
   return [ float(v[i])/vmag  for i in range(len(v)) ]

def normalizar(vetorIN, vetorOUT):
   arquivoHistogramas = open(vetorIN, "rb")
   arquivoSaida = open(vetorOUT + ".nor", "wb")
   lines = arquivoHistogramas.readlines()

   for line in lines:
      v = ""
      inner = 0
      j = string.split(line)
      v = normalize(j)
      
      arquivoSaida.write(" ".join(map(str, v)) + " \n")
   
   arquivoSaida.close()
   arquivoHistogramas.close()   

#################################################################

vetorIN=sys.argv[1]
vetorOUT=sys.argv[2]
normalizar(vetorIN,vetorOUT)
