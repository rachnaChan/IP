package cafe.i4a.cafe.services.drink;

import java.util.List;

import cafe.i4a.cafe.models.drink.drink;

public interface drinkService {

    List<drink> getAllDrink();

    drink saveDrink(drink drink);

    drink getDrinkById(Long id);

    drink updateVieId(Long id, drink newDrink);

}