x = int(input('nhap so nguyen x: '))
y = int(input('nhap so nguyen y: '))

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
        #print(x)
        if x == y:
            break;
    return step,string        
step,opera = minStep(x,y)
print("so buoc nho nhat:", step, "\n phep toan can thuc hien: ", opera)