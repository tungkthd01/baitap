from itertools import product, islice
 
 
def expr(p):
    return "{}1{}2{}3{}4{}5{}6{}7{}8{}9".format(*p)
 
 
def gen_expr():
    op = ['+', '-', '']
    
    return [expr(p) for p in product(op, repeat=9) if p[0] != '+']

#x = gen_expr()
def sum_to(val):
    for s in filter(lambda x: x[0] == val, map(lambda x: (eval(x), x), gen_expr())):
        print(s)
#print(x)
#sum_to(100)
def expression(*args,repeat=1):
    pools = [tuple(pool) for pool in args] * repeat
    result = [[]]
    for pool in pools:
        result = [x+[y] for x in result for y in pool]
    for prod in result:
        yield tuple(prod)
op = ['+','-','']
x = expression(op,3)
for i in x:
    print(i)

        