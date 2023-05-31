package cafe.i4a.cafe.services.implementations.cashier;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.cashier.register;
import cafe.i4a.cafe.repositories.cashier.registerRepository;
import cafe.i4a.cafe.services.cashier.registerService;
import lombok.extern.slf4j.Slf4j;

@Service
@Slf4j
public class registerImplementation implements registerService {

    @Autowired
    private registerRepository registerrepository;

    @Override
    public List<register> getAllCashiers() {
        return registerrepository.findAll();
    }

    @Override
    public register saveCashier(register user) {
        log.info("Existing user {}", user);
        // return null;
        return registerrepository.save(user);
    }

    @Override
    public register updateVieId(Long id, register newCashier) {
        register existCashier = new register();

        existCashier = registerrepository.findById(id).get();
        existCashier.setUsername(newCashier.getUsername());
        existCashier.setGender(newCashier.getGender());
        existCashier.setName(newCashier.getName());
        existCashier.setDob(newCashier.getDob());
        existCashier.setHired_date(newCashier.getHired_date());

        if(newCashier.getImage() != null){
         existCashier.setImage(newCashier.getImage());   
        }else{
            existCashier.setImage(existCashier.getImage());
        }
        
        
        existCashier.setEmail(newCashier.getEmail());

        return registerrepository.save(existCashier);

    }

    @Override
    public register getCashierById(Long id) {
        return registerrepository.findById(id).orElse(null);
    }



    @Override
    public register getByUsername(String username) {
        return registerrepository.findByUsername(username);
    }
}
