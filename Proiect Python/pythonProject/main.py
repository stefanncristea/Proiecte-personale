from Functions import *
from DetectFunction import *
import sys

if __name__ == '__main__':
    c, d, i, w, D, z, u, s, f, allr, h, v, group, error, filename = detect(sys.argv[2])
    if error == 0:
        uniq(filename, c, d, i, w, D, z, u, s, f, allr, h, v, group)
