package cafe.i4a.cafe.models.ordered;

import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.List;

import cafe.i4a.cafe.models.cashier.register;
import cafe.i4a.cafe.models.orderDetailDrink.orderedDetailDrinks;
import cafe.i4a.cafe.models.orderDetailFood.orderedDetailFoods;
import cafe.i4a.cafe.models.table.table;
import jakarta.persistence.CascadeType;
import jakarta.persistence.Entity;
import jakarta.persistence.FetchType;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.OneToMany;
import jakarta.persistence.Table;

@Entity
@Table(name="ordered")
public class ordered {
    @Id
    @GeneratedValue(strategy =  GenerationType.IDENTITY)
    private Long id;

    @OneToMany(cascade = CascadeType.ALL)
    @JoinColumn(name = "invoice_id", referencedColumnName = "id")
    private List <orderedDetailDrinks> orderDrinks = new ArrayList<>();

    @OneToMany(cascade = CascadeType.ALL)
    @JoinColumn(name = "invoice_id", referencedColumnName = "id")
    private List <orderedDetailFoods> orderFoods = new ArrayList<>();

    private Double totalPrice;
    private Double cashReceived;
    private Double changed;
    private Timestamp orderDate;

    @ManyToOne(fetch = FetchType.EAGER)
    @JoinColumn(name = "cashier_id", referencedColumnName = "id")
    private register cashier;

    @ManyToOne(fetch = FetchType.EAGER)
    @JoinColumn(name = "table_id", referencedColumnName = "id")
    private table Table;

    public ordered() {};

    public ordered(List<orderedDetailDrinks> orderDrinks, List<orderedDetailFoods> orderFoods, Double totalPrice,
            Double cashReceived, Double changed, Timestamp orderDate, register cashier, table table) {
        this.orderDrinks = orderDrinks;
        this.orderFoods = orderFoods;
        this.totalPrice = totalPrice;
        this.cashReceived = cashReceived;
        this.changed = changed;
        this.orderDate = orderDate;
        this.cashier = cashier;
        Table = table;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public List<orderedDetailDrinks> getOrderDrinks() {
        return orderDrinks;
    }

    public void setOrderDrinks(List<orderedDetailDrinks> orderDrinks) {
        this.orderDrinks = orderDrinks;
    }

    public List<orderedDetailFoods> getOrderFoods() {
        return orderFoods;
    }

    public void setOrderFoods(List<orderedDetailFoods> orderFoods) {
        this.orderFoods = orderFoods;
    }

    public Double getTotalPrice() {
        return totalPrice;
    }

    public void setTotalPrice(Double totalPrice) {
        this.totalPrice = totalPrice;
    }

    public Double getCashReceived() {
        return cashReceived;
    }

    public void setCashReceived(Double cashReceived) {
        this.cashReceived = cashReceived;
    }

    public Double getChanged() {
        return changed;
    }

    public void setChanged(Double changed) {
        this.changed = changed;
    }

    public Timestamp getOrderDate() {
        return orderDate;
    }

    public void setOrderDate(Timestamp orderDate) {
        this.orderDate = orderDate;
    }

    public register getCashier() {
        return cashier;
    }

    public void setCashier(register cashier) {
        this.cashier = cashier;
    }

    public table getTable() {
        return Table;
    }

    public void setTable(table table) {
        Table = table;
    }

    
    
}
