package cafe.i4a.cafe.services.implementations.drink;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.drink.drink;
import cafe.i4a.cafe.repositories.drink.drinkRepository;
import cafe.i4a.cafe.services.drink.drinkService;

@Service
public class drinkImplementation implements drinkService {

    @Autowired
    private drinkRepository drinkrepository;

    @Override
    public List<drink> getAllDrink() {
        return drinkrepository.findAll();
    }

    @Override
    public drink saveDrink(drink drink) {
        return this.drinkrepository.save(drink);
    }

    @Override
    public drink updateVieId(Long id, drink newDrink) {
        drink existDrink = new drink();

        existDrink = drinkrepository.findById(id).get();
        existDrink.setName(newDrink.getName());
        existDrink.setType(newDrink.getType());

        if(newDrink.getImage() != null){
         existDrink.setImage(newDrink.getImage());   
        }else{
            existDrink.setImage(existDrink.getImage());
        }
        
        existDrink.setDcode(newDrink.getDcode());

        return drinkrepository.save(newDrink);

    }

    @Override
    public drink getDrinkById(Long id) {
        return drinkrepository.findById(id).orElse(null);
    }

}