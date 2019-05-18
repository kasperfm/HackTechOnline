<ul>
    <li><strong>Username:</strong> <span class="highlight">{{ currentPlayer()->username }}</span></li>
    <li><strong>System role:</strong> <span class="highlight">{{ currentPlayer()->userRole }}</span></li>
    <li><strong>Register date:</strong> <span class="highlight">{{ currentPlayer()->model->created_at->toFormattedDateString() }}</span></li>
    <li><strong>Bank name:</strong> <span class="highlight">{{ currentPlayer()->economy->getBank()->bank_name }}</span></li>
    <li><strong>Bank account:</strong> <span class="highlight">{{ currentPlayer()->economy->getAccountNumber() }}</span></li>
</ul>
