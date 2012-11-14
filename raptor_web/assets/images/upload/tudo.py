#!/usr/local/bin/python
# coding: utf-8

import sys
import os
import string
import glob
	

def executa():
        path=""
        for fname in glob.glob(os.path.join(path, '*.jpg')):
               os.system("caracterizar.py " + fname + " " + fname)
               os.system("projetar.py " + fname[:-4] + ".key" + " dicionario-2000.pal " + fname[:-4])
               os.system("normalizar.py " + fname[:-4] + ".hist " + fname[:-4])
               os.system("del " + fname[:-4] + ".key")
               os.system("del " + fname[:-4] + ".hist")

#################################################################

executa()
