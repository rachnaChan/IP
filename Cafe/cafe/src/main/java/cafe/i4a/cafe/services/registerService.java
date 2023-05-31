package cafe.i4a.cafe.services;

import java.util.List;

import cafe.i4a.cafe.models.register;

public interface registerService {

    List <register> getAllCashiers();
    register saveCashier(register user);
    register getCashierById(Long id);

    register updateVieId(Long id, register newCashier);

}