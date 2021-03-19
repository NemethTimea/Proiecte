package FarmMed;

import java.util.ArrayList;
import java.util.List;

public class Farmacie {
	
	String numefarm;
	String loc;
	int numar;
	List<Medicament> medicamente = new ArrayList<>();
	/**
	 * @param numefarm
	 */
	public Farmacie(String numefarm, String loc, int numar, List<Medicament> medicamente) {
		super();
		this.numefarm = numefarm;
		this.loc = loc;
		this.numar = numar;
		this.medicamente = medicamente;
	}
	
	public String getLoc() {
		return loc;
	}

	public void setLoc(String loc) {
		this.loc = loc;
	}

	public int getNumar() {
		return numar;
	}

	public void setNumar(int numar) {
		this.numar = numar;
	}

	public Farmacie() {}

	@Override
	public String toString() {
		return "\nFarmacia " + numefarm + "\n -Loc  -> "+ loc +"\n        ~ MEDICAMENTE ~\n" +"    "+ medicamente+"\n";
	}

	public String getNumefarm() {
		return numefarm;
	}

	public void setNumefarm(String numefarm) {
		this.numefarm = numefarm;
	}

	public List<Medicament> getMedicamente() {
		return medicamente;
	}

	public void setMedicamente(List<Medicament> medicamente) {
		this.medicamente = medicamente;
	}
	
	public int find(String m) {
        for(int i = 0; i < this.medicamente.size(); i++) {
            if(this.medicamente.get(i).getNume().contains(m)) {
                return i;
            }
        }
        return -1;
    }
	public void cumpara(String s, int nr) {
        int poz = this.find(s);
        if(poz != -1) {
            nr = this.medicamente.get(poz).getBucati() - nr;
            this.medicamente.get(poz).setBucati(nr);
            if(this.medicamente.get(poz).getBucati() <= 0) {
                this.medicamente.remove(poz);
            }
        }
    }
	public void update(int poz, Medicament m) {
        if(poz != -1) {
            this.medicamente.get(poz).setBucati(m.getBucati()+medicamente.get(poz).getBucati());
        }
        else {
            this.medicamente.add(m);
        }
    }
	
}
