package cafe.i4a.cafe.services.implementations;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.register;
import cafe.i4a.cafe.repositories.registerRepository;
import cafe.i4a.cafe.services.registerService;

@Service
public class registerImplementation implements registerService {

    @Autowired
    private registerRepository registerrepository;

    @Override
    public List<register> getAllCashiers() {
        return registerrepository.findAll();
    }

    @Override
    public register saveCashier(register user) {
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
        existCashier.setImage(newCashier.getImage());
        existCashier.setEmail(newCashier.getEmail());
        existCashier.setPassword(newCashier.getPassword());

        return registerrepository.save(existCashier);

    }

    @Override
    public register getCashierById(Long id) {
        return registerrepository.findById(id).orElse(null);
    }

}
