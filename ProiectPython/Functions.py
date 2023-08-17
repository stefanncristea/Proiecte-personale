# simulating the uniq command in linux
import lines as lines


def uniq(filename, c,d,i,w,D,z,u,s,f,allr,h,v,grup):
    if h == 1:
        file = open("help.txt", "r")
        print(file.read())
    elif v == 1:
        print("uniq (GNU coreutils) 8.32")
        print("License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>.")
        print("This is free software: you are free to change and redistribute it.")
        print("There is NO WARRANTY, to the extent permitted by law.")
        print("Written by Paul Rubin and Mike Haertel.")
    else:
        file = open(filename, "r")
        if(z == 1):
            lines = file.read().split("\0")
        else:
            lines = file.readlines()
        cnt = 0
        if w == 0:
            w = 100
        elif w < s:
            w = 100
            s = 0
        while cnt <= len(lines)-1:
            count = 1
            group = 0
            j = cnt + 1
            if f != 0:
                fields = str(lines[cnt]).split()
                for word in fields:
                    if word == " ":
                        fields.remove(word)
                fields2 = []
                if j <= len(lines) - 1:
                    fields2 = str(lines[j]).split()
                    for word in fields2:
                        if word == " ":
                            fields2.remove(word)
                if i == 1:
                    while j < len(lines) and f <= len(fields)-1 and f<= len(fields2)-1 and fields[f].lower() == fields2[f].lower():
                        count += 1
                        j += 1
                        group = 1
                        fields2 = str(lines[j]).split()
                        for word in fields2:
                            if word == " ":
                                fields2.remove(word)
                else:
                    while j < len(lines) and f <= len(fields)-1 and f<= len(fields2)-1 and fields[f] == fields2[f]:
                        count += 1
                        j += 1
                        group = 1
                        fields2 = str(lines[j]).split()
                        for word in fields2:
                            if word == " ":
                                fields2.remove(word)
            else:
                if i == 1:
                    while j < len(lines) and lines[cnt][s:w].lower() == lines[j][s:w].lower():
                        count += 1
                        j += 1
                        group = 1
                else:
                    while j < len(lines) and lines[cnt][s:w] == lines[j][s:w]:
                        count += 1
                        j += 1
                        group = 1
            if u == 1:
                if c == 1 or d == 1 or D == 1:
                    print("Error: -u cannot be used with any other options")
                    break
                else:
                    if group == 0:
                        print(lines[cnt].strip())
            elif grup == 1:
                while count > 0:
                    print(lines[cnt].strip())
                    count -= 1
                print("")
            elif c == 1 and i == 1 and d == 0 and D == 0:
                print(str(count) + " " + lines[cnt].lower().strip())

            elif c == 1 and i == 0 and d == 0 and D == 0:
                print(str(count) + " " + lines[cnt].strip())

            elif c == 0 and i == 1 and d == 0 and D == 0:
                print(lines[cnt].lower().strip())

            elif c == 0 and i == 0 and d == 0 and D == 0:
                print(lines[cnt].strip())

            elif c == 0 and i == 0 and d == 1 and D == 0:
                if group == 1:
                    print(lines[cnt].strip())

            elif c == 0 and i == 0 and D == 1:
                if group == 1:
                    while count != 0:
                        print(lines[cnt].strip())
                        count -= 1
                    if allr == 1:
                        print("")
            elif c == 0 and i == 1 and d == 1 and D == 0:
                if group == 1:
                    print(lines[cnt].lower().strip())
            elif c == 0 and i == 1 and D == 1:
                if group == 1:
                    while count != 0:
                        print(lines[cnt].lower().strip())
                        count -= 1
                    if allr == 1:
                        print("")
            elif c == 1 and i == 0 and d == 1 and D == 0:
                if group == 1:
                    print(str(count) + " " + lines[cnt].strip())
            elif i == 1 and d == 1 and D == 0:
                if group == 1:
                    print(str(count) + " " + lines[cnt].lower().strip())
            cnt = j

#separate a string into a list of words with many spaces
def separate(string):
    words = []
    word = ""
    for i in range(len(string)):
        if string[i] != " ":
            word += string[i]
        else:
            words.append(word)
            word = ""
    words.append(word)
    return words

#verify if can open a file
def openfile(filename):
    try:
        file = open(filename, "r")
        return 1
    except:
        return 0