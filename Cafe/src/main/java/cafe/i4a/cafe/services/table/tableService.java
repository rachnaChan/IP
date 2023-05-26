package cafe.i4a.cafe.services.table;

import java.util.List;

import cafe.i4a.cafe.models.table.table;

public interface tableService {
    List<table> getAllTables();
    table saveTables(table tables);
    table getTableById(Long id);
    
}


