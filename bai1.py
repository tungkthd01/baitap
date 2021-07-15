
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

    
for s in filter(lambda x: x[0] == 100, map(lambda x: (eval(x), x), xx)):
    print(s)

