package cafe.i4a.cafe.drinkFoodOrder;

import java.util.ArrayList;
import java.util.List;

import cafe.i4a.cafe.models.drink.drink;
import cafe.i4a.cafe.models.food.food;

public class drinkFoodOrder {
    List<drink> cartDrink;
    public static List<drink> cartDrinks;
    static{
        cartDrinks = new ArrayList<>();
    }

    List<food> cartFood;
    public static List<food> cartFoods;
    static{
        cartFoods = new ArrayList<>();
    }
}
