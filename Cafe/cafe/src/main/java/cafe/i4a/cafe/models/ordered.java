package cafe.i4a.cafe.models;


import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name="orderdrink")
public class ordered {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

	@Column(name="name")
    private String name;

	@Column(name="size")
	private String size;

	@Column(name= "price")
    private double price;

  
	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }
		
	public String getSize() {
		return size;
	}

	public void setSize(String size) {
		this.size = size;
	}
	@Override
	public String toString() {
		return "orderd [id=" + id + ", name=" + name + ",size="+ size +", price=" 
	            + price + "]";
	}

	
	
    
}
