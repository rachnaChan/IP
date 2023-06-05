package cafe.i4a.cafe.models.drink;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name="drinksize")
public class drinkSize {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(name="drinktype")
    private String drinktype;

    @Column(name="size")
    private String size;

    @Column(name="price")
    private double price;

    public Long getId() {
        return id;
    }

    public drinkSize(){};

    public drinkSize(String drinktype, String size, double price) {
        this.drinktype = drinktype;
        this.size = size;
        this.price = price;
    }



    public void setId(Long id) {
        this.id = id;
    }

    public String getDrinktype() {
        return drinktype;
    }

    public void setDrinktype(String drinktype) {
        this.drinktype = drinktype;
    }

    public String getSize() {
        return size;
    }

    public void setSize(String size) {
        this.size = size;
    }

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    @Override
    public String toString(){
        return "drinksize[id="+id+", drinktype="+drinktype+", size="+size+", price="+price+"]";
    }

}
