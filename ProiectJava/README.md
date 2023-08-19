
# My File Transfer Protocol

Proiectul meu se numeste MyFileTransferProtocol si este o aplicatie de tip client-server.

-Odata inregistrat, fiecarui utilizator i se creeaza un fisier de baza cu numele acestuia. Incepand de la acel fisier el poate sa creeze fisiere si foldere cu numele dorit, ba chiar sa mute fisiere.

-Fiecare utilizator este bagat intr-o baza de date salvata in plac local la server. Cand un utilizator incearca sa creeze un cont deja existent acesta primeste o eroare.

-Functiile ce pot fi folosite si tin de utilizator sunt:

	->register: creeaza un cont.
	
	->login: logheza utilizatorul la un cont.
	
	->disconnect: deconecteaza utilizatorul de la contul acestuia.
	
	->exit: inchide clientul.

-Functiile ce pot fi folosite si tin de fisiere sunt:

	->list: listeaza directorul curent.
	
	->makefile: creeaza un fisier.
	
	->makefolder: creeaza un folder.
	
	->transferfile: transfera un fisier.


