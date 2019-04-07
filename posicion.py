
#TODO ESTA EN GRADOS!

def sol(p1,p2,d1,d2):
	
	#P1=d1*cos(B1)+d2*cos(B2)	
	#P2=d1*sin(B1)+d2*sin(B2)

	c1=p1^2+p2^2-d1^2+d2^2
	c2=2*d2*p1
	c3=2*d2*p2
	c4=c2^2+c3^2
	c5=2c1*c2
	c6=c1^2-c3^2
	
	x1=(c5+sqrt(c5^2-4*c4*c6))/(2*c4)
	x2=0
	w=[]
	if abs(x1)<=1:
		w.append([arccos(x1),-arccos(x1)])
	
	if abs(x2)<=1:
		w.append([arccos(x2),-arccos(x2)])
	

	for i in range(len(w)):
		z(i)=arcsin((1/d1)*(p2-d2*sin(w(i))))
		z(i+4)=180-z(i)	
	
		
	
	#8 posiciones posibles
	
	return w,z

def filtro1(z,w):
	#sol=[phi1,phi4]
	
	teta1=0
	teta2=180
	for i in range(len(z)):
		#servo_phi_1 teta1 < phi1 < teta2
		if z(i) > teta2 or z(i) < teta1:
			z.pop(i)
			
	for i in range(len(w)):
		#servo_phi_4 teta3 < phi1 < teta4
		if w(i) > teta4 or w(i) < teta3:
			w.pop(i)
		
	sol=[0,0]
	if len(z)<1 or len(w)<1:
		print("NO HAY SOLUCION")
	else:
		sol=[z(0),w(0)]
	
	
	return sol
	
def filtro2(z,w):
	#sol=[phi2,phi3]
	
	teta5=0
	teta6=180
	teta7=0
	teta8=180
	for i in range(len(z)):
		#servo_phi_2 teta5 < phi2 < teta6
		if z(i) > teta6 or z(i) < teta5:
			z.pop(i)
			
	for i in range(len(w)):
		#servo_phi_3 teta7 < phi3 < teta8
		if w(i) > teta8 or w(i) < teta7:
			w.pop(i)
		
	sol=[0,0]
	if len(z)<1 or len(w)<1:
		print("NO HAY SOLUCION")
	else:
		sol=[z(0),w(0)]
	
	
	return sol
	
def main:
	x=34
	y=34
	
	l1=160
	l2=148
	l3=54
	l4=42
	l5=68.81
	dx=34.40
	dy=24.22
	h=12 #OJO se puede ajustar --> altura de la articulacion O1
	
	#px=l2*cos(phi1)+l1*cos(phi4)+l4*cos(35)
	#py=l2*sin(phi1)+l1*sin(phi4)+h
	
	#l2*cos(phi1)=l3*cos(phi4)+l3*cos(phi2)+l1*cos(phi3)
	#l2*sin(phi1)=l3*sin(phi4)+l3*sin(phi2)+l1*sin(phi3)
	
	#1er sistema (resolvemos para phi1,phi4)
	p1=x-l4*cos(35)
	p2=y-h
	d1=l2
	d2=l1
	z,w = sol(p1,p2,d1,d2)
	[phi1,phi4]=filtro1(z,w)
	
	#2o sistema (resolvemos para phi2,phi3)
	p1=l2*cos(phi1)-l3*cos(phi4)
	p2=l2*sin(phi1)-l3*sin(phi4)
	d1=l3
	d2=l1
	z,w = sol(p1,p2,d1,d2)
	[phi2,phi3]=filtro2(z,w)
	
	#l2*cos(phi1)=l3*cos(phi4)+l3*cos(phi2)+l1*cos(phi3)
	#l2*sin(phi1)=l3*sin(phi4)+l3*sin(phi2)+l1*sin(phi3)
	
	coord =[phi1,phi2,phi3,phi4,x,y] #phi's, todo en GRADOS, x e y [mm] 
	
	return

		
