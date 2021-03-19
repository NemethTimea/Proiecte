package FarmMed;


public class Medicament {
	String nume;
	tipmed tip;
	double pret;
	int bucati;
	
	public tipmed getTip() {
		return tip;
	}

	public void setTip(tipmed tip) {
		this.tip = tip;
	}

	/**
	 * @param nume
	 * @param tip
	 * @param pret
	 */
	public Medicament(String nume, tipmed tip, double pret,int bucati) {
		super();
		this.nume = nume;
		this.tip = tip;
		this.pret = pret;
		this.bucati = bucati;
	}

	public void setBucati(int bucati) {
		this.bucati = bucati;
	}

	public Medicament() {}

	@Override
	public String toString() {
		return nume + " pentru  "+ tip +" --- "+ pret + "lei   | " +bucati+" bucati.\n";
	}

	public String getNume() {
		return nume;
	}

	public void setNume(String nume) {
		this.nume = nume;
	}

	public double getPret() {
		return pret;
	}

	public void setPret(double pret) {
		this.pret = pret;
	}
	
	public int getBucati() {
		return this.bucati;
	}

}
