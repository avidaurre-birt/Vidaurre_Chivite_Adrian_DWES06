package users.reforesta.apirest.Dao;

import java.util.List;

import users.reforesta.apirest.Entity.User;

public interface UserDAO {

	public List<User> findAll();
	
	public User findById(int id);
	
	public void save(User usuario);
	
	public void deleteById (int id);
	
}
