import { useState } from "react";

type Todo = {
  text: string;
  color: string;
};

export function TodoList() {
    const [todos, setTodos] = useState<Todo[]>([]);
    const [inputValue, setInputValue] = useState('');

    const ajouterTodo = () => {
        if (inputValue.trim() !== '') {
            setTodos([...todos, { text: inputValue.trim(), color: '#fff' }]);
            setInputValue(''); 
        }
         
    };
    const supprimerTodo = (indexToDelete: number) => {
    setTodos(todos.filter((_, index) => index !== indexToDelete));
    }

    const changerCouleur = (index: number) => {
        setTodos(todos.map((todo, i) => i === index ? {...todo, color: '#00ff00'}: todo))
    };

    return (
        <>
        
        <div className="container-todo">
            <div className="input-section">
                <input 
                type="text" 
                value={inputValue}
                onChange={(e) => setInputValue(e.target.value)}
                placeholder="Nouvelle tâche"
                />
                <button className="ajouter-btn" onClick={ajouterTodo}>Ajouter</button>
            </div>
            <ul>
                {todos.map((todo, index) => (
                <li key={index} style={{ backgroundColor: todo.color }}>
                    <span>{todo.text}</span>
                    <button className="fait-btn" onClick={() => changerCouleur(index)}>Fait</button>
                    <button className="supprimer-btn" onClick={() => supprimerTodo(index)}>Supprimer</button>
                </li>
                ))}
            </ul>
        </div>

        </>
    );
}
