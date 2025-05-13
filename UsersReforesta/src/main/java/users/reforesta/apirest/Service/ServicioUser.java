package users.reforesta.apirest.Service;

import java.util.List;

import users.reforesta.apirest.Entity.User;

public interface ServicioUser {

	public List<User> findAll();
	
	public User findById(int id);
	
	public void save (User user);
	
	public void deleteById (int id);
}
