package cafe.i4a.cafe.models.food;


import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Lob;
import jakarta.persistence.Table;


@Entity
@Table(name="food")
public class food {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

	@Column(name="name")
    private String name;

	@Column(name= "price")
    private double price;

    @Lob
    @Column(columnDefinition = "MEDIUMBLOB")
	private String image;
    
	public food() {this.image=null;};	
	public food(String name, double price, String image) {
		this.name = name;
		this.price = price;
		this.image = image;
	}

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
		
	public String getImage() {
		return image;
	}

	public void setImage(String image) {
		this.image = image;
	}
	
	@Override
	public String toString() {
		return "food [id=" + id + ", name=" + name + ", price=" 
	            + price + ", image=" + image + "]";
	}
    public food get() {
        return null;
    }

	
    
}
