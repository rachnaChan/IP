package cafe.i4a.cafe.services.implementations.table;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import cafe.i4a.cafe.models.table.table;
import cafe.i4a.cafe.repositories.table.tableRepository;
import cafe.i4a.cafe.services.table.tableService;

@Service
public class tableImplementation implements tableService {

    @Autowired
    private tableRepository tablerepository;

    @Override
    public List<table> getAllTables() {
        return tablerepository.findAll();
    }

    @Override
    public table getTableById(Long id) {
        return tablerepository.findById(id).orElse(null);
    }

    @Override
    public table saveTables(table tables) {
        return this.tablerepository.save(tables);
    }
}
