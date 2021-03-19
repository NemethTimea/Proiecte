package FarmMed;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;
import java.util.Scanner;

public class MAIN {
	public static List<Integer> findMed(List<Farmacie> lf, String nume) {
        int x = 0;
        List<Integer> l = new ArrayList<>();
        for(Farmacie f : lf) {
            List<Medicament> meds = f.getMedicamente();
            x++;
            for(Medicament m : meds) {
                if(m.getNume().contains(nume)) {
                    l.add(x);
                    System.out.println(x + " - " + f.getNumefarm() + " : " +  m.getBucati() + " bucati,  Pret: " + m.getPret() + " lei");
                    break;
                }
            }
        }
        return l;
    }
	
	public static void update(List<Farmacie> lf) {
        try {
            File temp_file = new File("src/FarmMed/temp.txt");
            temp_file.createNewFile();
            FileOutputStream fos = new FileOutputStream(temp_file);
            fos.write(String.valueOf(lf.size() + "\n").getBytes());
            for(Farmacie f : lf) {
                String name = f.getNumefarm() + "\n", loc = f.getLoc() + "\n";
                String nr_med = String.valueOf(f.getMedicamente().size() + "\n");
                fos.write(name.getBytes());
                fos.write(loc.getBytes());
                fos.write(nr_med.getBytes());
                List<Medicament> meds = f.getMedicamente();
                for(Medicament m : meds) {
                    String nmed = m.getNume() + "\n", tipmed = m.getTip().name() + "\n";
                    String bucati = String.valueOf(m.getBucati()) + "\n";
                    String pret = String.valueOf(m.getPret() + "\n");
                    fos.write(nmed.getBytes());
                    fos.write(tipmed.getBytes());
                    fos.write(pret.getBytes());
                    fos.write(bucati.getBytes());
                }
            }
            fos.close();
            Path source = Paths.get("src/FarmMed/temp.txt");
            Files.move(source, source.resolveSibling("fisier_date_farmacii"), StandardCopyOption.REPLACE_EXISTING);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }


	public static void stergeFarmacie(Scanner scanner, List<Farmacie> f) {
		if(f.size() == 0) {
			System.out.println("Nu mai exista nicio farmacie pe piata!");
		}
		else {
			for(int i = 0; i < f.size(); i++) {
				System.out.println("   * "+ f.get(i).getNumefarm()+ " -----> " + i );
			}
			System.out.print("\nIntroduceti numarul farmaciei pe care doriti sa-l stergeti : ");
			int poz = scanner.nextInt();
			f.remove(poz);
			System.out.println("S-a sters! :) ");
		}
	}
	
	public static boolean cautaMedicament(Farmacie f, String nume) {
		boolean exi = false;
        List<Medicament> meds = f.getMedicamente();
        for(Medicament m : meds) {
            if(m.getNume().contains(nume)) {
            	exi = true;
                System.out.println("Medicamentul "+m.getNume()+" este in farmacia "+f.getNumefarm() + "\n- de tip " + m.getTip() + "\n- " + m.getBucati() + " de bucati\n- cu pretul: " + m.getPret() + " lei");
            }
        }
        return exi;
    }	

    public static void cautaInFarmacii(List<Farmacie> lf, String nume) {
    	boolean e = false;
        for(Farmacie f : lf) {
             if(cautaMedicament(f, nume)) {
            	 e = true;
             }
        }
        if(!e) {
        	System.out.println("NU EXISTA MEDICAMENTUL "+nume);
        }
    }
	
	public static void afisare(List<Farmacie> f ) {
		for(Farmacie far: f) {
			System.out.println("\nFarmacia " + far.numefarm + "\n -Loc  -> "+ far.loc +"\n        ~ MEDICAMENTE ~\n");
			for(Medicament med: far.getMedicamente()) {
				System.out.println("  *  "+med);
			}
		}
	}
	
	public static tipmed tipul(String tip) {
		List<String> ltipuri = Arrays.asList(new String[] {"ANTIINFLAMATOARE", "ANALGEZICE", "ANTICOAGULANTE", "PROBIOTICE"});
		if(ltipuri.contains(tip)) {
			return tipmed.valueOf(tip);
		}
		return null;
	}
	
	public static void main(String[] args) {
		
		List<Farmacie> f = new ArrayList<>();

		try {
			File file = new File("src/FarmMed/fisier_date_farmacii");
			Scanner scan = new Scanner(file);
			
			int n = Integer.parseInt(scan.nextLine());
			for (int i = 0; i<n ; i++){
				
				String numef = scan.nextLine();
				String loc = scan.nextLine();
				int nrmed = Integer.parseInt(scan.nextLine());
				
				List<Medicament> m = new ArrayList<>();
				for (int j = 0; j<nrmed; j++) {
					
					 String numem = scan.nextLine();
					 String tip = scan.nextLine();
					 tipmed tipm = tipul(tip);
					 
					double pret = Double.parseDouble(scan.nextLine()); 
					int bucati = Integer.parseInt(scan.nextLine());
					m.add(new Medicament(numem,tipm,pret,bucati));
				}
				f.add(new Farmacie(numef,loc,nrmed,m));
			}
			scan.close();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		}
		//--------------------PROIECT-----------------------//
		
			System.out.println("\n                                                  -------- PROIECT FARMACIE --------\n");
			System.out.println("                                                            Bine Ati Venit!\n\n");
			System.out.println("                                             Pentru a alege o functionalitate, introduceti\n"); 
			System.out.println("                                                            un numar din meniu!\n\n");

		
		Scanner scanner = new Scanner(System.in);
		int aleg = -1;
		int aleg2 = -1;
		while(aleg != 0){
	        System.out.println("----------------------------------------------------------------------------------------------------------------------------------------------------------");
	        System.out.println("                                                       1. -> Afisarea farmaciilor.");
			System.out.println("                                                       2. -> Adauga o farmacie in lista.");
			System.out.println("                                                       3. -> Cauta o farmacie.");
			System.out.println("                                                       4. -> Elimina o farmacie.\n\n");
			
			System.out.println("                                                       5. -> Adauga un nou medicament la o farmacie.");
			System.out.println("                                                       6. -> Cauta un medicament.");
			System.out.println("                                                       7. -> Elimina un medicament.");
			System.out.println("                                                       8. -> Cumpara un medicament.");
			System.out.println("                                                       9. -> Top 3 farmacii cu cele mai multe medicamente.\n");
			System.out.println("                                                 10. -> Doresti sa salvezi modificarile? .\n\n");
			System.out.println("                                                   0. -> EXIT.");

			System.out.println("RASPUNSUL:");
			aleg = scanner.nextInt();
			scanner.nextLine();
			switch(aleg) {
			case 1: 
					afisare(f);
					break;
			case 2: 
				   System.out.println("Numele Farmaciei : ");
                   String numef = scanner.next();
                   scanner.nextLine();
                   System.out.println("Locul : ");
                   scanner.useDelimiter("\n");
                   String loc = scanner.next();
                   scanner.nextLine();
                   scanner.reset();
                   System.out.println("Cate medicamente? ");
                   int n = scanner.nextInt();
                   List<Medicament> m = new ArrayList<>();
                   for(int i = 1; i <= n; i++) {
                       scanner.nextLine();
                       System.out.println("Medicamentul " + i + "\n");
                       System.out.println("Numele:");
                       scanner.useDelimiter("\n");
                       String numem = scanner.next();
                       numem = numem.trim();
                       scanner.reset();
                       tipmed t = null;
                       while(t == null) {
                           System.out.println("Tipul (ANTIINFLAMATOARE, ANALGEZICE, ANTICOAGULANTE, PROBIOTICE): ");
                           String tip = scanner.next();
                           t = tipul(tip);
                           if(t == null) {
                               System.out.println("Tip gresit! Introduceti din nou ... ");
                           }
                       }
                       System.out.println("Pretul :");
                       double pret = scanner.nextDouble();
                       int bucati = -1;
                       while(bucati < 1) {
                           System.out.println("Cate bucati?");
                           bucati = scanner.nextInt();
                       }
                       m.add(new Medicament(numem,t,pret,bucati));
                   }
                   Farmacie nf = new Farmacie(numef, loc, n, m);
                   f.add(nf);
                   System.out.println("Am adaugat cu succes!\n\n");
                   break;
					
			case 3: 
				boolean exista = false;
				System.out.println("Ce farmacie cautati?");
				System.out.print("Introduceti numele:");
				String numeintrodus = scanner.next();
				for(Farmacie fa: f) {
					if(fa.getNumefarm().equals(numeintrodus)) {
						exista = true;
						System.out.println(fa.getLoc());
						for(Medicament me: fa.getMedicamente()) {
							System.out.println("  *  "+me);
						}
					}	
				}
				if(!exista) {
						System.out.println("NU EXISTA O ASEMENEA FARMACIE!");
				}
				break;
			case 4:
				stergeFarmacie(scanner,f);
				break;
			case 5:
				boolean ex = false;
				System.out.println("\n   Ati ales introducerea un medicament.\n");
				System.out.println("In care Farmacie doriti sa adaugati?");
				System.out.println("Numele: ");
				String numei = scanner.next();
				for(Farmacie far: f) {
					if(far.getNumefarm().equals(numei)) {
						ex = true;
						System.out.println(" *** Am gasit farmacia! *** ");
						System.out.println("Numele Medicamentului :");					
						scanner.useDelimiter("\n");
						scanner.nextLine();
						String numem = scanner.next();
						numem = numem.trim();
						scanner.reset();
						tipmed t = null;
						while(t == null) {
							System.out.println("Tipul (ANTIINFLAMATOARE, ANALGEZICE, ANTICOAGULANTE, PROBIOTICE): ");
							String tip = scanner.next();
							t = tipul(tip);
							if(t == null) {
								System.out.println("Tip gresit! Introduceti din nou ... ");
							}
						}
						System.out.println("Pretul :");
						double pret = scanner.nextDouble();
						scanner.nextLine();
						System.out.println("Cate bucati?");
						int bucati = scanner.nextInt();
						scanner.nextLine();
						far.getMedicamente().add(new Medicament(numem,t,pret,bucati));
						far.update(far.find(numem), new Medicament(numem,t,pret,bucati));
						System.out.println("Am adaugat cu succes! :) \n\n");
					}
				}
				if(!ex) {
					 System.out.println(" NU EXISTA FARMACIA --> "+numei);
				}
				break;
			case 6:
				System.out.println("Introduce numele medicamentului cautat: ");
				String s = scanner.next();
                cautaInFarmacii(f, s);
                break;
			case 7:
				System.out.println("    Ati ales sa stergeti un medicament.\nIntroduceti numele:");
				String num = scanner.next();
				boolean reusit = false;
				for(Farmacie far: f) {
					int i = 0;
					List<Medicament> lista_med = far.getMedicamente();
					for(Medicament med: lista_med) {
						if(med.getNume().contains(num)) {
							lista_med.remove(i);
							reusit = true;
							break;
						}
						i++;
					}
				}
				if(reusit) {
					System.out.println("Stergerea s-a efectuat cu succes! :) \n\n");
				}
				else System.out.println("Nu am putut strege. (nu exista)");
				break;
			case 8:
	            System.out.println("Care Medicament vreti sa cumparati?");
	            System.out.println("Numele: ");
                s = scanner.next();
                while(aleg2 != 0) {
                    List<Integer> x = findMed(f, s);
                    System.out.println("0 - Daca nu mai doriti.\nAlege o farmacie: ");
                    aleg2 = scanner.nextInt();
                    if(x.contains(aleg2)) {
                        int bucati = -1;
                        System.out.println("Numarul de medicamente dorite (0 - Daca nu mai doriti. ):");
                        while(bucati != 0) {
                            bucati = scanner.nextInt();
                            if(bucati > 0) {
                                f.get(aleg2 - 1).cumpara(s, bucati);
                                System.out.println("Ati cumparat "+bucati+" bucati de "+s+" de la Farmacia "+f.get(aleg2-1).getNumefarm());
                                bucati = 0;
                                aleg2 = 0;
                            }
                        }
                    }
                }
                aleg2 = -1;
                break;
			case 9:
				f.sort(new Comparator<>() {

					@Override
					public int compare(Farmacie o1, Farmacie o2) {
						
						return Integer.compare(o1.getMedicamente().size(), o2.getMedicamente().size());
					}
				});
				Collections.reverse(f);
				System.out.println("I. "+f.get(0));
				System.out.println("II. "+f.get(1));
				System.out.println("III. "+f.get(2));
				break;
			case 10:
				update(f);
				System.out.println("Modificarile au fost salvate in fisier");
			}
		}
		scanner.close();
	}
}
