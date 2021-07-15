x = int(input('enter integer x: '))
y = int(input('enter integer y: '))

def minStep(x,y):
    step = 0
    string = ""
    while(1):
        if x > y:
            x = x - 1
            string = string + "-"
            
        elif x*2 > y and y%2 == 0 :
            x = x - 1
            string = string + "-"
        elif x*2 > y and y%2 == 1:
            x = x*2
            string = string + "*"
        elif x*2 <= y:
            x = x*2
            string = string + "*" 
        step = step + 1 
        print(x)
        if x == y:
            return step,string
print(minStep(x,y))