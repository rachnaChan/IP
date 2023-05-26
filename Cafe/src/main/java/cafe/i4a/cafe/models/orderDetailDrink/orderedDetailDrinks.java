package cafe.i4a.cafe.models.orderDetailDrink;


import cafe.i4a.cafe.models.drink.drink;
import cafe.i4a.cafe.models.drink.drinkSize;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.FetchType;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;

@Entity
@Table(name = "orderdetaildrink")
public class orderedDetailDrinks {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;

	@Column(name = "total_price")
	private double totalPrice;

	@Column(name = "amount")
	private Long amount;

	@ManyToOne(fetch = FetchType.EAGER)
	@JoinColumn(name = "drink_id")
	private drink Drink;

	@ManyToOne(fetch = FetchType.EAGER)
	@JoinColumn(name = "drinksize_id")
	private drinkSize DrinkSize;

	public orderedDetailDrinks() {};

	public orderedDetailDrinks(double totalPrice, Long amount, drink drink, drinkSize drinkSize) {
		this.totalPrice = totalPrice;
		this.amount = amount;
		Drink = drink;
		DrinkSize = drinkSize;
	}

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public double getTotalPrice() {
		return totalPrice;
	}

	public void setTotalPrice(double totalPrice) {
		this.totalPrice = totalPrice;
	}

	public Long getAmount() {
		return amount;
	}

	public void setAmount(Long amount) {
		this.amount = amount;
	}

	public drink getDrink() {
		return Drink;
	}

	public void setDrink(drink drink) {
		Drink = drink;
	}

	public drinkSize getDrinkSize() {
		return DrinkSize;
	}

	public void setDrinkSize(drinkSize drinkSize) {
		DrinkSize = drinkSize;
	}

	


	
}
