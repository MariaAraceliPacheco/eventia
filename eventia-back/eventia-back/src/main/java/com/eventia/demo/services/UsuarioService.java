package com.eventia.demo.services;

import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

import com.eventia.demo.dto.usuarios.UsuarioInsertDTO;
import com.eventia.demo.dto.usuarios.UsuarioUpdateDTO;
import com.eventia.demo.entidades.Usuario;
import com.eventia.demo.repositories.UsuarioRepository;

@Service
public class UsuarioService {
	private final UsuarioRepository usuarioRepo;

	public UsuarioService(UsuarioRepository usuarioRepo) {
		this.usuarioRepo = usuarioRepo;
	}

	public Usuario crear(UsuarioInsertDTO dto) {
		Usuario u = new Usuario();
		u.setNombre(dto.getNombre());
		u.setEmail(dto.getEmail());
		u.setFechaRegistro(dto.getFecha_Registro());
		u.setPassword(dto.getPassword());
		u.setTipoUsuario(dto.getTipo_usuario().name());
		return usuarioRepo.save(u);
	}

	public List<Usuario> obtenerTodos() {
		return usuarioRepo.findAll();
	}

	public Usuario obtenerPorId(int id) {
		return usuarioRepo.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND));
	}

	public Usuario modificar(int id, UsuarioUpdateDTO dto) {
		Usuario a = obtenerPorId(id);
		a.setNombre(dto.getNombre());
		a.setEmail(dto.getEmail());
		a.setPassword(dto.getPassword());
		a.setTipoUsuario(dto.getTipo_usuario().name());
		
		return usuarioRepo.save(a);
	}

	public void eliminar(int id) {
		if (!usuarioRepo.existsById(id))
			throw new ResponseStatusException(HttpStatus.NOT_FOUND);
		usuarioRepo.deleteById(id);
	}

}
