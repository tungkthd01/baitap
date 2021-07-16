
op = ['+','-','']
a = ['1','5','9']
def expr(p):
    return "{}1{}2{}3{}4{}5{}6{}7{}8{}9".format(*p)
def product(*args, repeat=1):

    pools = [tuple(pool) for pool in args] * repeat
    result = [[]]
    
    for pool in pools:
        nresult = []
        for x in result:
            for y in pool:            
                nresult.append(x+[y])      
        result = nresult 
    return result

xx = [expr(p) for p in product(op, repeat=9) if p[0] != '+']

def myFunc(x):
    if x == 100:
        return True
    else:
        return False

# for s in filter(lambda x: myFunc(x[0]), map(lambda x: (eval(x), x), xx)):
#     print(s)
y = map(lambda x: (eval(x),x), xx)
for i in y:
    if myFunc(i[0]):
        print(i)