package users.reforesta.apirest.Controller;


import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import users.reforesta.apirest.Service.ServicioUser;
import users.reforesta.apirest.Entity.User;

@RestController
@RequestMapping("/users")
public class UserController {

	@Autowired
	private ServicioUser userServicio;
	
	@GetMapping("/get")
	public ResponseEntity<?> findAll() {
	    List<User> users = userServicio.findAll();
	    return ResponseEntity.ok(
	        Map.of(
	            "message", "HTTP 200: Usuarios encontrados",
	            "data", users
	        )
	    );
	}
	
	@GetMapping("/get/{id}")
	public ResponseEntity<?> getUser(@PathVariable int id) {
	    try {
	        User user = userServicio.findById(id);
	        if (user != null) {
	            return ResponseEntity.status(HttpStatus.OK).body(Map.of(
	                    "message", "HTTP 200: Usuario encontrado",
	                    "data", user
	                ));  
	        } else {
	            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(
	                    Map.of("error", "HTTP 404: Usuario no encontrado")
	                    );
	        }
	    } catch (Exception e) {
	        e.printStackTrace();
	        return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body(null);  // Error -> HTTP 500
	    }
	}
	
	
	@PostMapping("/save")
	public ResponseEntity<Map<String, Object>> saveUser(@RequestBody User usuario) {
		
		try {
	        userServicio.save(usuario);
	        return ResponseEntity.ok(Map.of("message", "HTTP 200: Usuario guardado correctamente")); 

	    } catch (Exception e) {
	        return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body(Map.of("error", "Error al guardar el usuario: " + e.getMessage()));
	    }	
	}
	
	
	@DeleteMapping("/delete/{id}")
	public ResponseEntity<?> deleteUser(@PathVariable int id) {
	    try {
	        User user = userServicio.findById(id);
	        
	        if (user == null) {
	            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(
	                Map.of("error", "HTTP 404: Usuario no encontrado")
	            );
	        }
	        
	        userServicio.deleteById(id);
	        return ResponseEntity.ok(
	            Map.of("message", "HTTP 200: Usuario eliminado correctamente")
	        );
	        
	    } catch (Exception e) {
	        return ResponseEntity.internalServerError().body(
	            Map.of("error", "Error al eliminar: " + e.getMessage())
	        );
	    }
	}
	

}
