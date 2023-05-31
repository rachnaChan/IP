package cafe.i4a.cafe.services;

import java.util.List;

import cafe.i4a.cafe.models.table;

public interface tableService {
    List<table> getAllTables();
    table saveTables(table tables);
    table getTableById(Long id);
    
}


