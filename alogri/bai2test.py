x = int(input('enter integer x: '))
y = int(input('enter integer y: '))



def find_nb_step(x,y):
    nb_step=0
    logs=''
    while(True):
        if x>y:
            x=x-1
            logs=logs+'-'
        elif x*2<=y:
            x=x*2
            logs=logs+'*'
        elif x*2>y and y%2==1:
            x=x*2
            logs=logs+'*'
        elif x*2>y and y%2==0:
            x=x-1
            logs=logs+'-'
        else:
            input('err')

        # print(x)
        # input(logs)
        nb_step+=1

        if x==y:
            return nb_step,logs

nb_step,logs=find_nb_step(x,y)
print('nb_step',nb_step)
print('logs',logs)