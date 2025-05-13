package users.reforesta.apirest.Dao;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;
import org.hibernate.Session;
import jakarta.persistence.EntityManager;
import jakarta.persistence.Query;


import users.reforesta.apirest.Entity.User;

@Repository
public class UserDAOImpl implements UserDAO {

	@Autowired
	private EntityManager entityManager;
	
	@Override
	@Transactional
	public List<User> findAll() {
		Session currentSession=entityManager.unwrap(Session.class);

	    List<User> users = currentSession.createQuery("from User", User.class).getResultList();
	    
	    return users;
	}

	@Override
	@Transactional
	public User findById(int id) {
	
		Session currentSession=entityManager.unwrap(Session.class);
		try {
			User user = currentSession.get(User.class, id);
		
			return user;
		}catch (Exception e) {

	        System.out.println("Usuario no encontrado: " + e.getMessage());
	        return null;
	    }
	}

	@Override
	public void save(User usuario) {
		Session currentSession = entityManager.unwrap(Session.class);
		
		try {
	        currentSession.save(usuario);
	        System.out.println("Usuario guardado correctamente: " + usuario.getNombre());
	    } catch (Exception e) {
	        System.out.println("Error al guardar el usuario: " + e.getMessage());
	    }

	}

	@Transactional
	@Override
	public void deleteById(int id) {
		Session currentSession=entityManager.unwrap(Session.class);
		
		 try {		        
		        User user = currentSession.get(User.class, id);
		        
		        if (user != null) {
		            currentSession.remove(user);
		            System.out.println("Usuario eliminado con éxito: ID " + id);
		        } else {
		            System.out.println("Usuario no encontrado para eliminar: ID " + id);
		        }
		    } catch (Exception e) {
		        System.out.println("Error al eliminar el usuario: " + e.getMessage());
		    }

	}

}
