



789
456-
123+
0,/=


from tkinter import *
if __name__ == "main":
    gui = Tk()
    
    gui.configure(background="#101419")
    gui.title("calculatrice")
    equation = StringVar()
    
    resultat = Label(gui, bg="#101419", fg="#FFF", textvariable=equation, height="2")
    resultat.grid(columnspan=4)
    
    boutons = [7, 8, 9,, "*", 4, 5, 6, "-", 1, 2, 3, "+", 0, ".", "/", "="]
    ligne = 1
    colonne = 0
    
    fot bouton in boutons:
        b = Label(gui, text=str(boutun), bg="#476C98")
        b.bind("<Button-1>", print)
        b.grid(row=ligne, column=colonne)
        
        colonne += 1
        if colonne == 4:
            colonne = 0
            ligne += 1
    
    b = Label(gui, text="Effacer", bg="#984447", fg="#FFF", height=4, width=26)