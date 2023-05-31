package cafe.i4a.cafe.models.orderDetailFood;

import cafe.i4a.cafe.models.food.food;
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
@Table(name = "orderdetailfood")
public class orderedDetailFoods {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;


	// amount * food price
	@Column(name = "total_price")
	private double totalPrice;

	@Column(name = "amount")
	private Long amount;

	@ManyToOne(fetch = FetchType.EAGER)
	@JoinColumn(name = "food_id")
	private food Food;


	public orderedDetailFoods() {};

	public orderedDetailFoods(double totalPrice, Long amount, food food) {
		this.totalPrice = totalPrice;
		this.amount = amount;
		Food = food;
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

	public food getFood() {
		return Food;
	}

	public void setFood(food food) {
		Food = food;
	}

    public food get() {
		return Food;

    }

}
