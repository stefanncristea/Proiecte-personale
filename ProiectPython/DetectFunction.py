#add in an array all the functions uniq linux command has
def detect(sir):
    c = d = i = w = D = z = u = s = f = allr = h = v = group = error = 0
    filename = ""
    functions = []
    functions.append("-c")
    functions.append("-d")
    functions.append("-i")
    functions.append("-D")
    functions.append("-u")
    functions.append("-c")
    functions.append("-w")
    functions.append("-s")
    functions.append("-f")
    functions.append("-z")
    functions.append("--v")
    functions.append("-h")
    functions.append("--zero-terminated")
    functions.append("--all-repeated")
    functions.append("--group")
    functions.append("--help")
    functions.append("--version")
    functions.append("--skip-fields")
    functions.append("--check-chars")
    functions.append("--ignore-case")
    functions.append("--repeated")
    functions.append("--count")
    x = sir.split()
    for word in x:
        if word == " ":
            x.remove(word)
    if x[0] != "uniq":
        print("Error: command not found")
        error = 1
    else:
        j = 1
        while j < len(x) - 1:
            if x[j] not in functions:
                print("Error: invalid option " + x[j])
                error = 1
                break
            if x[j] == "-c" or x[j] == "--count":
                if c == 1:
                    print("Error: -c cannot be used more than once")
                    error = 1
                    break
                else:
                    c = 1
            elif x[j] == "-d" or x[j] == "--repeated":
                if d == 1:
                    print("Error: -d can be used only once")
                    error = 1
                    break
                else:
                    d = 1
            elif x[j] == "-i" or x[j] == "--ignore-case":
                if i == 1:
                    print("Error: -i can be used only once")
                    error = 1
                    break
                else:
                    i = 1
            elif x[j] == "-D" or x[j] == "--all-repeated":
                if D == 1:
                    print("Error: -D already used")
                    error = 1
                    break
                else:
                    D = 1
                    if x[j] == "--all-repeated":
                        allr = 1
            elif x[j] == "-u" or x[j] == "--unique":
                if u == 1:
                    print("Error: -u can be used only once")
                    error = 1
                    break
                else:
                    u = 1
            elif x[j] == "-s" or x[i] == "--skip-chars":
                if s == 0:
                    if(x[j+1].isdigit()):
                        s = int(x[j+1])
                        j += 1
                    else:
                        print("Error: -s must be followed by a number")
                        error = 1
                        break
                else:
                    print("Error: -s can be used only once")
                    error = 1
                    break
            elif x[j] == "--group":
                if group == 1:
                    print("Error: --group can only be used once")
                    error = 1
                    break
                else:
                    group = 1
            elif x[j] == "-z" or x[j] == "--zero-terminated":
                if z == 1:
                    print("Error: -z can only be used once")
                    error = 1
                    break
                else:
                    z = 1
            elif x[j] == "--help" or x[j] == "-h":
                if h == 1:
                    print("Error: --help can only be used once")
                    error = 1
                    break
                else:
                    h = 1
            elif x[j] == "--version" or x[j] == "--v":
                if v == 1:
                    print("Error: --version can only be used once")
                    error = 1
                    break
                else:
                    v = 1
            elif x[j] == "--skip-fields" or x[j] == "-f":
                if f == 0:
                    if(x[j+1].isdigit()):
                        f = int(x[j+1])
                        j += 1
                    else:
                        print("Error: invalid argument for --skip-fields")
                        error = 1
                        break
                else:
                    print("Error: --skip-fields or -f can only be used once")
                    error = 1
                    break
            elif x[j] == "--check-chars" or x[j] == "-w":
                if w == 0:
                    if(x[j+1].isdigit()):
                        w = int(x[j+1])
                        j += 1
                    else:
                        print("Error: invalid argument for --check-chars")
                        error = 1
                        break
                else:
                    print("Error: -w can only be used once")
                    error = 1
                    break
            j += 1

    if error == 0:
        if c == 1 and D == 1:
            print("Error: -c and -D cannot be used together")
            error = 1
        elif c == 1 and u == 1:
            print("Error: -c and -u cannot be used together")
            error = 1
        elif group == 1 and (d == 1 or D == 1 or u == 1 or c == 1):
            print("Error: --group cannot be used with -d, -D, -u or -c")
            error = 1
    if x[len(x) - 1] == "--v" or x[len(x) - 1] == "--version":
        v = 1
    elif x[len(x) - 1] == "-h" or x[len(x) - 1] == "--help":
        h = 1
    else:
        filename = x[len(x) - 1]
    return c,d,i,w,D,z,u,s,f,allr,h,v,group,error,filename
