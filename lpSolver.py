import numpy as np
import pandas as pd
from sklearn.model_selection import train_test_split
from scipy.optimize import linprog
from sklearn import metrics


data_val = pd.read_csv('train.csv')

ind=data_val.loc[:,:].values
X=ind[0:2000,0:20]
y=ind[0:2000,20:21]

for sp in [0.9,0.8,0.7]:
    X_train, X_test,y_train,y_test=train_test_split(X,y,train_size=sp,random_state=500)

    A=np.multiply(X,y)
    B=np.zeros(20)
    C=np.ones(2000)
    #count=0

    lp_solver = linprog(B,A_ub=-A,b_ub = C,bounds =[None,None])

    X_train=np.asarray(X_train, dtype='float64')

    predictions=np.sign(np.matmul(X_test,lp_solver.x))
    #print(predictions)
    print("Accuracy with ",sp*100,"% training set = ",(np.sum(y_train == predictions) / len(data_val)))